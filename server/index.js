var express = require('express');
var swig    = require('swig');
var path    = require('path');

var app = express();

// Configurations
app.engine('html', swig.renderFile);
app.set('view engine', 'html');
app.set('view cache', false);
app.set('views', path.join(__dirname, '..', 'pages'));
swig.setDefaults({ cache: false });

// Pages
app.get('/', require('./home'));

// Staring the server
app.listen(3000, function(){
    console.log('Server started. Listening to http://localhost:3000');
});
