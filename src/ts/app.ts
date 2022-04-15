window.EventHandler = require('../../node_modules/bootstrap/js/src/dom/event-handler.js');
window.Alert = require('bootstrap/js/dist/alert');
window.Button = require('bootstrap/js/dist/button');
window.Tooltip = require('bootstrap/js/dist/tooltip');

class App {
    constructor() {
        this.init();
    }

    init() {
        console.log('hola mundo 4');
    }
}

new App();

export default App;
