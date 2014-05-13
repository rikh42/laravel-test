
# Called before the symlink is switched over

shared_path = ::File.expand_path("#{release_path}/../../shared")

Chef::Log.info("=== Hook: before_symlink for #{release_path}")
Chef::Log.info("= Shared path is #{shared_path}")


# Set up the DB config so the app can access it
#Chef::Log.info("= Creating link to Database config file")
#execute "OpsWorks.php Link setup" do
#	cwd release_path
#	command "ln -s #{release_path}/../../shared/opsworks.php #{release_path}/opsworks.php"
#	action :run
#end


# Make some folders writable
execute "fixup storage folder" do
  command "chmod -R 777 #{release_path}/app/storage"
end

# Run Database Migrations
Chef::Log.info("= Running artisan DB migration")
execute "artisan migrate" do
	cwd release_path
	command "php artisan migrate --env=production"
	action :run
end



# clear memcached etc

