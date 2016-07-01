var express = require('express');
var app     = express();


app.get('/', function(req, res) {
    res.send('oi');
});


app.listen(3000, function(){
    console.log('Server started. Listening to http://localhost:3000');
});
