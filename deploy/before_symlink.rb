
# Run DB migrations etc here...



Chef::Log.info("=== Hook: before_symlink for #{release_path}")

shared_path = ::File.expand_path("#{release_path}/../../shared")
Chef::Log.info("= Shared path is #{shared_path}")


# Run 'composer install'
Chef::Log.info("= Running artisan DB migration")
execute "composer install" do
	cwd release_path
	command "php artisan migrate --env=production"
	action :run
end

