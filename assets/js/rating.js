jQuery(document).ready(function ($) {
	if (!$('#rating-stars').length) {
		return;
	}

	$('#rating-stars').find('span').on('mouseover',
		function () {
			$(this).nextAll('span').removeClass('dashicons-star-filled').addClass('dashicons-star-empty');
			$(this).prevAll('span').removeClass('dashicons-star-empty').addClass('dashicons-star-filled');
			$(this).removeClass('dashicons-star-empty').addClass('dashicons-star-filled');
		}
	);
	$('#rating-stars').find('span').on('click',
		function (e) {
			e.preventDefault();
			var ratings = $('#rating-stars').data('ratings') + 1;
			var rating = Math.round(($('#rating-stars').data('rating') * (ratings - 1) + $(this).data('rating')) / ratings * 10) / 10;

			var full_stars = Math.floor(rating);
			var half_stars = Math.ceil(rating - full_stars);
			var empty_stars = 5 - full_stars - half_stars;
			var html = '';
			for (i = 0; i < full_stars; i++) {
				html += '<span class="dashicons dashicons-star-filled"></span>';
			}
			for (var i = 0; i < half_stars; i++) {
				html += '<span class="dashicons dashicons-star-half"></span>';
			}
			for (var i = 0; i < empty_stars; i++) {
				html += '<span class="dashicons dashicons-star-empty"></span>';
			}

			$.ajax({
				type   : "POST",
				url    : seo_wp_object.ajaxurl,
				data   : {
					action : 'process_post_rating',
					post_id: $('#rating-stars').data('id'),
					rate   : $(this).data('rating')
				},
				success: function () {
					$('#rating').text(rating);
					$('#ratings').text(ratings);
					$('#rating-stars').remove();
					$('#star-ratings').removeClass('rating');
					$('#star-ratings').html(html);
				},
				error  : function () {
				}
			});
		}
	);

});

