class DynamicFrontEnd < Sinatra::Base

  set :public_folder => "public", :static => true

  get "/" do
    # Oj.dump(@articles)
    erb :index
  end

  get "/login/signin" do
  	@title = "Elder Net"
    erb :signin
  end

  get "/login/signup" do
  	@title = "Elder Net"
    erb :signup
  end

  post "/login/signup" do
  	# content_type :json
  	users = DB[:users]
	# check = DB[%Q(SELECT * FROM users WHERE username = '#{params[:username]}' or phone = '#{params[:phone]}')].all
	# if check.empty? do
	# 	users.insert(username: params[:username])
	# else
	# end
	# %Q(SELECT * FROM users WHERE username = '#{params[:username]}' or phone = '#{params[:phone]}')
	%Q(#{params})
  end

  get "/news" do
  	@title = "Elder Net"
    @articles = DB[:articles].all
    erb :news
  end
end
