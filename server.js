var http = require('http').Server();
var io = require('socket.io')(http, {
    cors: {
        origin: "*",
    }
});

var Redis = require('ioredis');

var redis = new Redis();

//redis.subscribe('news-action');
redis.psubscribe("news-action.*");
//redis.on('message', function (channel, message) {
redis.on('pmessage', function (pattern, channel, message) {
    console.log('Message received: ' + message);
    console.log('Channel: ' + channel);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

http.listen(6003, function() {
    console.log('Listening port: 6001');
});
