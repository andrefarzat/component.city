var swig = require('swig');

module.exports = function(req, res) {
    var data = {'components': []};
    data.components.push({'name': 'oca', 'url': '/oca'});
    res.render('home.html', data);
};
