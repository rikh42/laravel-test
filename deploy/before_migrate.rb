
Chef::Log.info("=== Hook: before_migrate for #{release_path}")

shared_path = ::File.expand_path("#{release_path}/../../shared")
Chef::Log.info("= Shared path is #{shared_path}")


# Run 'composer install'
Chef::Log.info("= Running Composer to install dependencies...")
execute "composer install" do
	cwd release_path
	command "composer install --no-dev --no-interaction --optimize-autoloader"
	action :run
end

