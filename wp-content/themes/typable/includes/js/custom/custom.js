jQuery(document).ready(function( $ ) {

	//-----------------------------------  // Ajax Magic //-----------------------------------//

	if ((custom_js_vars.toggle_ajax) == 'enabled') { 
	
		// Establish Variables
		var History = window.History,
		    State = History.getState(),
		    $log = $('#log'),
		    loading = false,
		    $loader = $('.icon-nav'),
	      getContent, loadAjax, doSearch;

		// Push the requested page url and title to History if a user asks for a new page
		getContent = function(element, title){
			if (loading === false){
			  var path = element.attr('href');
			  History.pushState('ajax',title,path);
			}
	    return false;
		};

		$('#main').on('click', '.next-prev a, .entry-title a, .excerpt-link, .archive-box a, .nav a', function(){
			getContent( $(this), $(this).data('title') );
	    return false;
		});

		$('#archive-list a,#nav-list a,.featured-image').on('click', function(){
			getContent( $(this), $(this).text() );
	    return false;
		});

		// Bind to state change

		// When the statechange happens, load the appropriate url via ajax
		History.Adapter.bind(window,'statechange',function() {
	    	loadAjax();
		});

		// Load content with ajax using pushed history state
		loadAjax = function() {
	    	loading = true;
			$loader.prepend('<i class="icon-spinner"></i>');

			State = History.getState();

			$(".icon-spinner").fadeIn();
			$(".posts").fadeTo(200,.3);

			var stateURL = encodeURI(State.url);

			$("#main").load(stateURL + ' #main', function(data) {
			    // This code will be run once the ajax page has loaded. Place your scripts here to be run after the AJAX page loads.

			    // Reset page elements now that content has loaded
			    $(".posts").fadeTo(200,1);
			    $(".icon-spinner").fadeOut();
			    $(".icon-spinner").remove();
			    $(".icon-nav a").removeClass("active");
			    $(".icon-folder-close").removeClass('icon-folder-open');
			    $("body").removeClass('body-header-open');
			    $(".header").removeClass('header-open');
			    $("#searchform,#nav-list,#archive-list,#widget-drawer").slideUp();

			    // Scroll to the top of the page
			    $("html, body").animate({
			      scrollTop: $(".header").offset().top
			    }, 500);

			    // Rerun Fitvid
			    $(".post").fitVids();

			    // Loading is complete. It's now safe to load again.
			    loading = false;
			});
		}

		// AJAX Search
		doSearch = function(){
			var searchTerm = $('.search-form-input').val();

			if (searchTerm != WPLANG['type_your_search'] && loading === false){
			  var searchTerm = encodeURIComponent(searchTerm);
			  var searchPath = WPCONFIG['site_url'] + '?s=' + searchTerm;

			  History.pushState('ajax', 'Search results', searchPath);
			}
		};

		// Search via ajax on form submission
		$(".search-form").submit( function(e){
			e.preventDefault();
			doSearch();
		});

		// Also search upon input field blur.
		// This triggers search if iOS users tap "Done"
		// instead of "Go", which they may well do.
		$(".search-form-input").blur( function(e){
			doSearch();
		});

	} //End AJAX

	//-----------------------------------  // Header Area Javascript //-----------------------------------//

	// Icon Nav
	$(".icon-nav a").click(function(){
		$(this).toggleClass('active');
		$(".icon-nav a").not(this).removeClass();

	    return false;
	});

	// Search Toggle
	$("#searchform").hide();
	$(".search-toggle").click(function() {
		$("#archive-list,#nav-list,#widget-drawer").slideUp(300);
		$("#searchform").slideToggle(300);
    	$(".header").removeClass('header-open');
    	$(".search-form-input").val(WPLANG['type_your_search']);
		return false;
	});

	// Archive TToggle
	$("#archive-list").hide();
	$("#archive-toggle").click(function () {
		$("#archive-toggle").toggleClass("open-folder");
		$("#searchform,#nav-list,#widget-drawer").slideUp(300);
		$("#archive-list").slideToggle(300);
		return false;
	});

	// Widget Toggle
	$("#widget-drawer").hide();
	$(".drawer-toggle").click(function () {
		$("#searchform,#nav-list,#archive-list").slideUp(300);
		$("#widget-drawer").slideToggle(300);
		$(".icon-folder-close").removeClass('icon-folder-open');
		return false;
	});

	// Nav Toggle
	$("#nav-list").hide();
	$(".nav-toggle").click(function () {
		$("#searchform,#archive-list,#widget-drawer").slideUp(300);
		$("#nav-list").slideToggle(300);
		$(".icon-folder-close").removeClass('icon-folder-open');
		return false;
	});

	//FitVids
	$(".post").fitVids();

});