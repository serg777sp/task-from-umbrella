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

window.App.Views.Form = Backbone.View.extend({
    initialize: function(){
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
	$('#link-add-form-div').html(this.el);
	return this;
    }
});

var form = new window.App.Models.Form;
var formView = new window.App.Views.Form({model:form});



