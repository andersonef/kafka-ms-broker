<?php

namespace App\Services\Queue;

use App\Connections\Database\PostgresConnection;
use App\Entities\RequestEntity;
use App\Repositories\Database\RequestRepository;
use Kafka\Producer;
use Kafka\ProducerConfig;

class KafkaService
{

    protected $producer;

    public function __construct()
    {
        $config = ProducerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList('kafka-ms-kafka:9092');
        $config->setBrokerVersion('1.0.0');
        $config->setRequiredAck(1);
        $config->setIsAsyn(false);
        $config->setProduceInterval(500);
        $this->producer = new Producer();
    }

    public function send($message, $topic): void
    {
        $this->producer->send([
            'topic' => $topic,
            'value' => $message,
            'key' => ''
        ]);
    }
}
