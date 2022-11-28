#testing 6.2 RC1 Messenger/Rate Limiter integration

## Description

With this setup using postgres as a Lock (supports both blocking and sharing), 
When using Fixed_Window 
a single consumer produce 2 messages at the time limit
multiple consumers produces 2 messges at the time limit per consumer

When using Token_Bucket
a single consumer produce 2 messages at the time limit

## Installation etc

```shell
docker-compose up -d
```

jump onto the container

```shell
docker exec -it bug-php81-container sh
```

fill the queue with 50 messages


```shell
bin/console app:fillqueue
```

consume messages

```shell
bin/console messenger:consume -vv
```