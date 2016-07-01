module.exports = function(req, res) {
    var component = {name: 'media'};
    res.render('component.html', {component})
};
