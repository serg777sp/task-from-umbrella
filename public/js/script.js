window.App = {
    Models:{},
    Views:{}
};

//models-----------------
window.App.Models.Home = Backbone.Model.extend();

window.App.Models.Form = Backbone.Model.extend({
    defaults:{
	originalUrl:'',
	shortUrl:''
    },
    validate: function(){
	this.checkOriginalUrl();
	this.checkShortUrl();
    },
    loadDefaults: function(){
	this.originalUrl = $('#link-add-form-original-url').val();
	this.shortUrl = $('#link-add-form-short-url').val();
    },
    checkOriginalUrl: function(){
	$.get({
	    url: '/link/check',
	    data:{
		original_url:this.originalUrl
	    },
	    success:function(res){
		if(res.errors){
		    $('#link-add-form-original-url').removeClass('field-success');
		    $('#link-add-form-original-url').addClass('field-with-error');
		    $.each(res.messages, function(key, value){
			$('#original-url-errors').append("<li>"+value+"</li>");
		    });
		} else  {
		    $('#original-url-errors').empty();
		    $('#link-add-form-original-url').removeClass('field-with-error');
		    $('#link-add-form-original-url').addClass('field-success');

		}
	    }
	});
    },
    checkShortUrl: function(){
	if(this.shortUrl){
	    $.get({
		url: '/link/short/check',
		data:{
		    short_url:this.shortUrl
		},
		success:function(res){
		    if(res.errors){
			$('#link-add-form-short-url').removeClass('field-success');
			$('#link-add-form-short-url').addClass('field-with-error');
			$.each(res.messages, function(key, value){
			    $('#short-url-errors').append("<li>"+value+"</li>");
			});
		    } else  {
			$('#short-url-errors').empty();
			$('#link-add-form-short-url').removeClass('field-with-error');
			$('#link-add-form-short-url').addClass('field-success');
		    }
		}
	    });
	}
    }
});

window.App.Models.Links = Backbone.Model.extend({
    load: function(){
	$.get({
	    url: '/links',
	    success:function(res){
		if(!res.errors){
		    $('#links-table').append(res.links);
		} else {
		    console.log(res.message);
		}
	    }
	});
    }
});


///views-------------------------
window.App.Views.Form = Backbone.View.extend({
    initialize: function(){
	$('title').text('Link Add');
	$('.active').removeClass();
	$('#menu-link-add').addClass('active');
	$('.panel-heading').text('Form for adding a new link');
	this.render();
    },
    template: _.template($('#link-add-form-template').html()),
    events:{
	'change': 'changeForm'
    },
    changeForm: function(){
	this.model.loadDefaults();
	this.model.validate();
    },
    render: function(){
	this.$el.html(this.template);
	$('#main').html(this.el);
	return this;
    }
});

window.App.Views.Home = Backbone.View.extend({
    initialize:function(){
	$('title').text('Home page');
	$('.active').removeClass();
	$('#menu-home').addClass('active');
	$('.panel-heading').text('Information on home page.');
	this.render();
    },
    template: _.template($('#home-template').html()),
    render:function(){
	this.$el.html(this.template);
	$('#main').html(this.el);
	return this;
    }

});

window.App.Views.Links = Backbone.View.extend({
    initialize:function(){
	$('title').text('All links');
	$('.active').removeClass();
	$('#menu-links').addClass('active');
	$('.panel-heading').text('All links table.');
	this.render();
	this.model.load();
    },
    template: _.template($('#links-template').html()),
    render:function(){
	this.$el.html(this.template);
	$('#main').html(this.el);
	return this;
    }
});


//Routing ---------------------------------
window.App.Router = Backbone.Router.extend({
    routes:{
	'':'index',
	'link-add':'linkAdd',
	'links':'links'
    },
    index: function(){
	new window.App.Views.Home({ model: new window.App.Models.Home});
    },
    linkAdd: function(){
	new window.App.Views.Form({ model: new window.App.Models.Form});
    },
    links:function(){
	new window.App.Views.Links({ model: new window.App.Models.Links});
    }
});

new App.Router; Backbone.history.start();