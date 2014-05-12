
#current_release = release_path


# Run 'composer install'
execute "composer install" do
	cwd release_path
	command "composer install --no-dev --no-interaction"
	action :run
end

