require 'json'
require 'net/http'
require 'uri'
require 'rbconfig'
require 'io/console'

puts "Enter Username:"
@username = gets.chomp
puts "Enter Password (input will be hidden):"
@password = STDIN.noecho(&:gets).chomp
puts "\n"
puts "\n"
puts "\n"
# BASE_URL = "http://eldernet.herokuapp.com/apps"
BASE_URL = "http://localhost:5000/apps"

@os ||= (
  host_os = RbConfig::CONFIG['host_os']
  case host_os
  when /mswin|msys|mingw|cygwin|bccwin|wince|emc/
    :windows
  when /darwin|mac os/
    :macosx
  when /linux/
    :linux
  when /solaris|bsd/
    :unix
  else
    raise Error::WebDriverError, "unknown os: #{host_os.inspect}"
  end
)


def send_data(apps_data, platform)
  uri = URI.parse(BASE_URL)
  response = Net::HTTP.post_form(uri, {"username" => @username,
                                       "password" => @password,
                                       "apps" => apps_data,
                                       "platform" => platform,
                                       })

  if JSON.parse(response.body)[":success"] == true
  	puts "Sync Successful"
  else
  	puts "Sync Failed"
  end
end


if @os == :macosx
  Dir.chdir "/Applications"
  apps = []
  Dir['*.app'].each do |fname|
    apps.push(fname.chomp(File.extname(fname)))
  end
  send_data(URI.escape(apps.to_json), "Mac OSX")
else
  puts "Platfrom not recognised."
end
