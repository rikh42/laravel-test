
# Run DB migrations etc here...


# Run 'composer install'
execute "composer install" do
	cwd release_path
	command "php artisan migrate --env=production"
	action :run
end

