# kafka-ms-broker
Broker microservice.
This is part 1 of 4 of an entire system.

# Diagram

<img src="https://raw.githubusercontent.com/andersonef/kafka-ms-broker/master/ms-diagram.png">

## Legend
<ul>
    <li><strong style="color: #D5E8D4">Green</strong>: Broker Microservice. kafka-ms-broker</li>
    <li><strong style="color: #DAE8FC">Blue</strong>: Requester Microservice. kafka-ms-requester</li>
    <li><strong style="color: #F8CECC">Orange</strong>: Kafka Instance. kafka-ms-kafka</li>
    <li><strong style="color: #FFF2CC">Yellow</strong>: Service A Microservice. kafka-ms-service-a</li>
</ul>

# Usage

In order to put this microservice on, you'll need to follow the following steps:

```shell
$ git clone https://github.com/andersonef/kafka-ms-broker kafka-ms-broker
$ cd kafka-ms-broker
$ chmod +x ./scripts/up.sh
$ ./scripts/up.sh
```

# Endpoints

## POST /request

This endpoint will create a new request inside database and send it to kafka's topic-a

## GET /request
### Params:
 - token: request token

 Will retrieve a request by its token
