<?php

// @codeCoverageIgnoreStart
class HttpClient
{
    private Logger $logger;

    public function __construct(
        Logger $logger
    ) {
        $this->logger = $logger;
    }

    public function get(string $url): array
    {
        $execute = function () use ($url): array {
            $this->logger->register("INFO", "HTTP_CLIENT", "Fazendo requisição");
            $this->logger->register("DEBUG", "HTTP_CLIENT", "METHOD: GET");
            $this->logger->register("DEBUG", "HTTP_CLIENT", "URL: $url");

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);

            $this->logger->register("DEBUG", "HTTP_CLIENT", "Response: \n\n".$output);

            $output_json = json_decode($output, true);
            return $output_json;
        };

        try {
            return $execute();
        } catch (\Exception $e) {
            $this->logger->register("ERROR", "HTTP_CLIENT", "Erro ao fazer requisição");
            $this->logger->register("ERROR", "HTTP_CLIENT", "Message: \n\n".$e->getMessage());
            $this->logger->register("ERROR", "HTTP_CLIENT", "Trace: \n\n".json_encode($e->getTrace()));

            throw $e;
        }
    }

    public function post()
    {
    }
}
// @codeCoverageIgnoreEnd
