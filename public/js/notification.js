function markNotificationsAsRead(notificationCount)
{
	if (notificationCount !== '0')
	{
		$.get('http://localhost/laravel_5_8/travel_blog/public/markAsRead');
	}
}