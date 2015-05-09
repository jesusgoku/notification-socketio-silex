var config = {
    SOCKETIO_PORT: 8888,
    SOCKETIO_HOST: '0.0.0.0',
    HTTP_PORT: 26300,
    HTTP_HOST: 'localhost'
};

var io = require('socket.io').listen(config.SOCKETIO_PORT);
var app = require('express')();
//var http = require('http').Server(app);

app.get('/emit/:id', function (req, res) {
    io.sockets.emit(req.params.id, req.query.message);
    res.json('OK');
});

app.listen(config.HTTP_PORT, config.HTTP_HOST);

console.log('SOCKET LISTEN ON PORT: ' + config.SOCKETIO_PORT);
console.log('HTTP LISTEN ON: http://' + config.HTTP_HOST + ':' + config.HTTP_PORT);

//http.listen(config.HTTP_PORT, function () {
//    console.log('Listen on: ' + config.HTTP_PORT);
//});
