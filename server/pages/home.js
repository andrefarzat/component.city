var path = require('path');
var fs   = require('fs');
var yaml = require('js-yaml');

module.exports = function(req, res) {
    var components     = [];
    var componentsPath = path.join(__dirname, '..', '..', 'components');
    var folders        = fs.readdirSync(componentsPath);

    folders.forEach(foldername => {
        var dataFilePath = path.join(componentsPath, foldername, 'data.yml');
        var dataFileStat = fs.statSync(dataFilePath);

        if (!dataFileStat.isFile()) {
            console.warn(`${dataFilePath} doesn't exist! Ignoring this component for now.`);
            return;
        }

        var file = fs.readFileSync(dataFilePath, 'utf8');
        var data = yaml.safeLoad(file);

        data.name = foldername;
        data.url  = '/' + foldername;
        components.push(data);
    });

    res.render('home.html', {components});
};
