environment     = :production #:development
# firesass        = true
#
http_path = "/"
css_dir         = "css"
sass_dir        = "sass"
images_dir      = "images"
# extensions_dir  = "sass-extensions"

output_style    = (environment == :development) ? :expanded : :compressed
relative_assets = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
line_comments = false

# sass_options    = (environment == :development && firesass == true) ? {:debug_info => true} : {}
