$(document).ready(function() {

	$('.btn-user').click(function() {
		if ($('#btnUserDashboard').hasClass('collapsed')) {
			$('#headerUser').collapse('show');
		} else {
			$('#headerUser').collapse('hide');
		}
	});

	$('.btn-history-redeem').click(function() {
		$('#headerUser').collapse('show');
	});

});