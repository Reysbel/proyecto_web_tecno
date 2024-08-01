// CodeMirror, copyright (c) by Marijn Haverbeke and others
// Distributed under an MIT license: http://codemirror.net/LICENSE

(function (mod) {
  "use strict";
  if (typeof exports === "object" && typeof module === "object") {// CommonJS
    mod(require("../../lib/codemirror"),
        require("../../addon/mode/overlay"),
        require("../xml/xml"),
        require("../javascript/javascript"),
        require("../coffeescript/coffeescript"),
        require("../css/css"),
        require("../sass/sass"),
        require("../stylus/stylus"),
        require("../pug/pug"),
        require("../handlebars/handlebars"));
  } else if (typeof define === "function" && define.amd) { // AMD
    define(["../../lib/codemirror",
            "../../addon/mode/overlay",
            "../xml/xml",
            "../javascript/javascript",
            "../coffeescript/coffeescript",
            "../css/css",
            "../sass/sass",
            "../stylus/stylus",
            "../pug/pug",
            "../handlebars/handlebars"], mod);
  } else { // Plain browser env
    mod(CodeMirror);
  }
})(function (CodeMirror) {
  var tagLanguages = {
    script: [
      ["lang", /coffee(script)?/, "coffeescript"],
      ["type", /^(?:text|application)\/(?:x-)?coffee(?:script)?$/, "coffeescript"],
      ["lang", /^babel$/, "javascript"],
      ["type", /^text\/babel$/, "javascript"],
      ["type", /^text\/ecmascript-\d+$/, "javascript"]
    ],
    style: [
      ["lang", /^stylus$/i, "stylus"],
      ["lang", /^sass$/i, "sass"],
      ["lang", /^less$/i, "text/x-less"],
      ["lang", /^scss$/i, "text/x-scss"],
      ["type", /^(text\/)?(x-)?styl(us)?$/i, "stylus"],
      ["type", /^text\/sass/i, "sass"],
      ["type", /^(text\/)?(x-)?scss$/i, "text/x-scss"],
      ["type", /^(text\/)?(x-)?less$/i, "text/x-less"]
    ],
    template: [
      ["lang", /^vue-template$/i, "vue"],
      ["lang", /^pug$/i, "pug"],
      ["lang", /^handlebars$/i, "handlebars"],
      ["type", /^(text\/)?(x-)?pug$/i, "pug"],
      ["type", /^text\/x-handlebars-template$/i, "handlebars"],
      [null, null, "vue-template"]
    ]
  };

  CodeMirror.defineMode("vue-template", function (config, parserConfig) {
    var mustacheOverlay = {
      token: function (stream) {
        if (stream.match(/^\{\{.*?\}\}/)) return "meta mustache";
        while (stream.next() && !stream.match("{{", false)) {}
        return null;
      }
    };
    return CodeMirror.overlayMode(CodeMirror.getMode(config, parserConfig.backdrop || "text/html"), mustacheOverlay);
  });

  CodeMirror.defineMode("vue", function (config) {
    return CodeMirror.getMode(config, {name: "htmlmixed", tags: tagLanguages});
  }, "htmlmixed", "xml", "javascript", "coffeescript", "css", "sass", "stylus", "pug", "handlebars");

  CodeMirror.defineMIME("script/x-vue", "vue");
  CodeMirror.defineMIME("text/x-vue", "vue");
});
Echo.private('pedidos')
    .listen('PedidoWebCreated', (e) => {
        // Mostrar la notificación (puedes usar Notification API)
        new Notification('Nuevo Pedido', {
            body: `Pedido #${e.pedido.id} ha sido creado`,
            icon: 'ruta/a/icono.png' // Opcional: ruta a un icono para la notificación
        });

        // Actualizar la lista de notificaciones en la interfaz
        let notificationList = document.getElementById('notification-list');
        let newNotification = document.createElement('a');
        newNotification.classList.add('dropdown-item', 'dropdown-item-unread');
        newNotification.href = `/pedidos/${e.pedido.id}`;
        newNotification.innerHTML = `
            <div class="dropdown-item-icon bg-primary text-white">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="dropdown-item-desc">
                Nuevo Pedido #${e.pedido.id}
                <div class="time text-primary">${new Date().toLocaleTimeString()}</div>
            </div>
        `;
        notificationList.prepend(newNotification);
    });
