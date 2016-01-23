//////////////////////////////////////////////////////////////////
// Add One_half button
//////////////////////////////////////////////////////////////////
(function() {
    tinymce.create('tinymce.plugins.one_half', {
        init : function(ed, url) {
            ed.addButton('one_half', {
                title : 'Add a one_half column',
                image : url+'/btn_1.png',
                onclick : function() {
                     ed.selection.setContent('[one_half last="no"]...[/one_half]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('one_half', tinymce.plugins.one_half);
})();

//////////////////////////////////////////////////////////////////
// Add one_third button
//////////////////////////////////////////////////////////////////
(function() {
    tinymce.create('tinymce.plugins.one_third', {
        init : function(ed, url) {
            ed.addButton('one_third', {
                title : 'Add a one_third column',
                image : url+'/btn_2.png',
                onclick : function() {
                     ed.selection.setContent('[one_third last="no"]...[/one_third]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('one_third', tinymce.plugins.one_third);
})();

//////////////////////////////////////////////////////////////////
// Add one_fourth button
//////////////////////////////////////////////////////////////////
(function() {
    tinymce.create('tinymce.plugins.one_fourth', {
        init : function(ed, url) {
            ed.addButton('one_fourth', {
                title : 'Add a one_fourth column',
                image : url+'/btn_3.png',
                onclick : function() {
                    ed.selection.setContent('[one_fourth last="no"]...[/one_fourth]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('one_fourth', tinymce.plugins.one_fourth);
})();

//////////////////////////////////////////////////////////////////
// Add one_fifth button
//////////////////////////////////////////////////////////////////
(function() {
    tinymce.create('tinymce.plugins.one_fifth', {
        init : function(ed, url) {
            ed.addButton('one_fifth', {
                title : 'Add a one_fifth column',
                image : url+'/btn_4.png',
                onclick : function() {
                    ed.selection.setContent('[one_fifth last="no"]...[/one_fifth]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('one_fifth', tinymce.plugins.one_fifth);
})();

//////////////////////////////////////////////////////////////////
// Add two_third button
//////////////////////////////////////////////////////////////////
(function() {
    tinymce.create('tinymce.plugins.two_third', {
        init : function(ed, url) {
            ed.addButton('two_third', {
                title : 'Add a two_third column',
                image : url+'/btn_5.png',
                onclick : function() {
                    ed.selection.setContent('[two_third last="no"]...[/two_third]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('two_third', tinymce.plugins.two_third);
})();

//////////////////////////////////////////////////////////////////
// Add two_fifth button
//////////////////////////////////////////////////////////////////
(function() {
    tinymce.create('tinymce.plugins.two_fifth', {
        init : function(ed, url) {
            ed.addButton('two_fifth', {
                title : 'Add a two_fifth column',
                image : url+'/btn_6.png',
                onclick : function() {
                    ed.selection.setContent('[two_fifth last="no"]...[/two_fifth]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('two_fifth', tinymce.plugins.two_fifth);
})();

//////////////////////////////////////////////////////////////////
// Add three_fourth button
//////////////////////////////////////////////////////////////////
(function() {
    tinymce.create('tinymce.plugins.three_fourth', {
        init : function(ed, url) {
            ed.addButton('three_fourth', {
                title : 'Add a three_fourth column',
                image : url+'/btn_7.png',
                onclick : function() {
                    ed.selection.setContent('[three_fourth last="no"]...[/three_fourth]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('three_fourth', tinymce.plugins.three_fourth);
})();

//////////////////////////////////////////////////////////////////
// Add three_fifth button
//////////////////////////////////////////////////////////////////
(function() {
    tinymce.create('tinymce.plugins.three_fifth', {
        init : function(ed, url) {
            ed.addButton('three_fifth', {
                title : 'Add a three_fifth column',
                image : url+'/btn_8.png',
                onclick : function() {
                    ed.selection.setContent('[three_fifth last="no"]...[/three_fifth]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('three_fifth', tinymce.plugins.three_fifth);
})();

//////////////////////////////////////////////////////////////////
// Add four_fifth button
//////////////////////////////////////////////////////////////////
(function() {
    tinymce.create('tinymce.plugins.four_fifth', {
        init : function(ed, url) {
            ed.addButton('four_fifth', {
                title : 'Add a four_fifth column',
                image : url+'/btn_9.png',
                onclick : function() {
                    ed.selection.setContent('[four_fifth last="no"]...[/four_fifth]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('four_fifth', tinymce.plugins.four_fifth);
})();