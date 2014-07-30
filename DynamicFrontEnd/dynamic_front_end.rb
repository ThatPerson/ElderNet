require 'rack-flash'


class DynamicFrontEnd < Sinatra::Base

  set :public_folder => "public", :static => true
  enable :sessions
  use Rack::Flash
  set :session_secret, "e9a37a7612ad2b501c648ccba28b4a539e31c9a732452b677b2b7d39d9daa39da18b06da24b9efdfd5ea312789ded1fd776bc722f842f66a02d3357c246c56de"

  get "/" do
    @title = "Elder Net"
    erb :index
  end

  get "/login/signin" do
    if session['username'].nil?
      @title = "Elder Net"
      erb :signin
    else
      redirect '/'
    end
  end

  post "/login/signin" do
    if session['username'].nil?
      @title = "Elder Net"
      if !params[:username].empty? & !params[:password].empty?
        users = DB[:users]
        user = users.where(username: params[:username])
        if !user.empty?
          if user.first[:password] == BCrypt::Engine.hash_secret(params[:password], user.first[:salt])
            session['username'] = params[:username]
            redirect "/"
          else
            flash[:message] = "Wrong password!"
            erb :signin
            # content_type :json
            # Oj.dump([user.first[:password], BCrypt::Engine.hash_secret(params[:password], user.first[:salt])])
          end
        else
          flash[:message] = "No user with that name!"
          erb :signin
        end
      else
        flash[:message] = "Some fields are missing"
        erb :signin
      end
    else
      redirect '/'
    end
  end

  get "/login/signup" do
    @title = "Elder Net"
    erb :signup
  end

  get "/logout" do
    session['username'] = nil
    redirect "/"
  end

  post "/login/signup" do
    @title = "Elder Net"
    if params[:password] == params[:re_password]
      check = DB[%Q(SELECT * FROM users WHERE username = '#{params[:username]}' or phone = '#{params[:phone]};')].all
      if !check.empty?
        flash[:message] = 'This username or phone number is already taken!'
        erb :signup
      else
        users = DB[:users]
        password_salt = BCrypt::Engine.generate_salt
        password_hash = BCrypt::Engine.hash_secret(params[:password], password_salt)
        users.insert(username: params[:username], password: password_hash, phone: params[:phone], salt: password_salt)
        session['username'] = params[:username]
        redirect '/'
      end
    else
      flash[:message] = "Passwords don't match!"
      erb :signup
    end
  end

  # post "/login/signup" do
  #   users = DB[:users]
  #   check = DB[%Q(SELECT * FROM users WHERE username = '#{params[:username]}' or phone = '#{params[:phone]}')].all
  #   # if check.empty? do
  #   #     users.insert(username: params[:username], )
  #   #     else
  #   #     end
  #   # %Q(SELECT * FROM users WHERE username = '#{params[:username]}' or phone = '#{params[:phone]}')
  #   # %Q(#{params})
  # end

  get "/news" do
    @title = "Elder Net"
    @articles = DB[:articles].all
    erb :news
  end
end
