<?php

require_once __DIR__."/DatabaseSingleton.php";

class Logger
{
    public function register(string $level, string $context, string $description): void
    {
        $pdo = DatabaseSingleton::getInstance();

        $datetime = date("Y-m-d H:i:s");
        $level = strtoupper($level);
        $context = strtoupper($context);

        try {
            $stmt = $pdo->prepare("INSERT INTO Log (datetime, level, context, description) VALUES (:datetime, :level, :context, :description)");

            $stmt->bindParam(':datetime', $datetime);
            $stmt->bindParam(':level', $level);
            $stmt->bindParam(':context', $context);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
        } catch (\Exception $e) {
            var_dump($e->getTrace());
            var_dump($e->getMessage());
        }
    }
}
