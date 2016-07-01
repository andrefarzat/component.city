var express = require('express');
var swig    = require('swig');
var path    = require('path');

const ROOT_DIR      = path.join(__dirname, '..');
const TEMPLATES_DIR = path.join(ROOT_DIR, 'templates');
const STATIC_FOLDER = path.join(ROOT_DIR, 'public');

var app = express();

// Configurations
app.engine('html', swig.renderFile);
app.set('view engine', 'html');
app.set('view cache', false);
app.set('views', TEMPLATES_DIR);
swig.setDefaults({ cache: false });

// Static folder

app.use('/static', express.static(STATIC_FOLDER));

// Pages
app.get('/', require('./pages/home'));
app.get('/styleguide', require('./pages/styleguide'));

// Staring the server
app.listen(3000, function(){
    console.log('Server started. Listening to http://localhost:3000');
});
