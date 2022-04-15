const { series } = require('gulp');
const Workflow = require('laravel-workflow');

const wf = new Workflow('Hola mundo cruel!');

wf.sayMessage();

module.exports = {
    default: series((cb) => cb())
}
