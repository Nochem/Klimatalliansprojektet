//$ is the same as writing jQuery
$(document).ready(function(){
	//BASIC SELECTORS
	//Detta väljer alla paragrafer på webbsidan och ger 
	//dem en 4 pixlar tjock kant
	$('p').css('border', '4px solid red');
	$('#wrapper').css({
		'position' : 'absolute',
		'left' : '50%',
        'top' : '50%',
        'margin-left' : -$('#wrapper').outerWidth()/2,
        'margin-top' : -$('#wrapper').outerHeight()/2
	});
	//Det är helt enkelt taggen på insidan av parantesen som säger
	//som påverkas av 
});