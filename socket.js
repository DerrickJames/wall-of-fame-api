var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();
var port = 3000;
var socketJwt = require('socketio-jwt');

redis.subscribe('current-user');

redis.on('message', function(channel, message) {
    message = JSON.parse(message);

    console.log('Channel: ', channel);
    console.log('Message: ', message);

    io.emit(channel + ':' + message.event, message.data);
});

console.log('Socket Server listening to port ' + port);

server.listen(port);
