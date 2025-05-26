<?php
class GeminiService
{
    private $baseURL = 'https://generativelanguage.googleapis.com/v1beta/models/';
    private $options = [
        'http' => [
            'method'        => 'POST',
            'header'        => "Content-Type: application/json\r\n",
            'ignore_errors' => true,
            'content'       => ''
        ]
    ];

    /**
     * 単一プロンプトでまとめて診断するメソッド
     * @param array  $records  health_records から取得した連想配列の配列
     * @param string $model    使用モデル名
     * @return string|null     Gemini の生成テキスト
     */
    public function chat(array $records, string $model = 'gemini-2.0-flash'): ?string
    {
        $url = sprintf(
            '%s%s:generateContent?key=%s',
            $this->baseURL,
            $model,
            GEMINI_API_KEY
        );

        // プロンプトを組み立て
        $lines = ["健康記録、体重(kg)、脈拍(bpm)、血圧(mmHg)の全体傾向と、特に注意すべきポイントを３点以内で日本語で教えてください。"];
        foreach ($records as $r) {
            $lines[] = sprintf(
                "%s：%.1fkg、%dbpm、%d/%d",
                $r['recorded_at'],
                $r['weight'],
                $r['heart_rate'],
                $r['systolic'],
                $r['diastolic']
            );
        }
        // 配列を改行で結合してプロンプトを作成
        $prompt = implode("\n", $lines);

        // リクエストボディ作成
        $requestData = [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ];

        // JSONエンコードしてHTTPリクエストのコンテキストを作成
        $this->options['http']['content'] = json_encode($requestData, JSON_UNESCAPED_UNICODE);
        $context = stream_context_create($this->options);

        // Gemini API へリクエスト
        $response = @file_get_contents($url, false, $context);
        if ($response === false) {
            return null;
        }
        // JSONレスポンスをデコード
        $json = json_decode($response, true);
        // プロンプトの応答を返す
        return $json['candidates'][0]['content']['parts'][0]['text'] ?? null;
    }
}
