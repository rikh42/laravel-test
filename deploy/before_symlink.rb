
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


# A method to changing owner of paths and permissions
#execute "chown app cache and log dirs to deploy:www-data" do
#    user "root"
#    cwd release_path
#    command "mkdir -p app/cache; chown -R deploy:www-data app/cache; chown -R deploy:www-data app/logs; find app/cache -type d | xargs -r chmod 0770; find app/cache -type f | xargs -r chmod 0660; find app/logs -type d | xargs -r chmod 0770; find app/logs -type f | xargs -r chmod 0660;"
#    action :run
#end

# Run Database Migrations
Chef::Log.info("= Running artisan DB migration")
execute "artisan migrate" do
	cwd release_path
	command "php artisan migrate --env=production"
	action :run
end



# clear memcached etc

