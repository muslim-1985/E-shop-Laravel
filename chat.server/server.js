let io = require('socket.io')(6001);
let Redis = require('ioredis');
let redis = new Redis();
redis.psubscribe('*', (error, count)=>{
    if(error) {
        console.log(error)
    }
    console.log(count);
});
redis.on('pmessage', (pattern, channel, message)=>{
    message = JSON.parse(message);
    //формируем событие по которому на фронтенде отлавливаем его
    io.emit(channel +':'+message.event, message.data.message);
    console.log(channel, message);
});
