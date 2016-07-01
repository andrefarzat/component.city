var path = require('path');
var fs   = require('fs');

module.exports = function(req, res) {
    var components     = [];
    var styleguidePath = path.join(__dirname, '..', '..', 'templates', 'styleguide');
    var files          = fs.readdirSync(styleguidePath);


    files.forEach(filename => {
        if (filename === 'index.html') return;

        var name     = filename.split('.')[0];
        var url      = '#' + name;
        var template = path.join(styleguidePath, filename);
        components.push({name, url, template});
    });

    console.log(components);

    res.render('styleguide/index.html', {components});
};
