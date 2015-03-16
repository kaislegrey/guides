#Gulp.js, Sass & Foundation 5#
###Setting up a new theme and using gulp.js to set up a watch and compile task###

Some notes:
If this is to be drupal theme, the root directory must be **"sites/all/themes/custom/[your-theme-name]"**

All your theme files and folders will reside in this folder

####Outcomes####

To have a gulp workflow that, with a single process, watches for any sass changes and then compiles sass source into css

Steps to achieve goals
make sure you have all required dependencies

If you have not have npm, gulp, or bower, you need to install them.

to install npm

    $ brew install npm

to install gulp

    $ npm install -g gulp

to install bower

    $ npm install -g bower

-----------

NOTE: that most often gulp will already be installed globally. If it isnt, install it like this via the command line

    $ npm install gulp -g

Navigate to your theme directory

initialize your project with a package.json file

    $ npm init

We also need to install gulp locally within our project (https://www.npmjs.com/package/gulp-git)

Install via the command line with

    $ npm install gulp --save-dev

This installs gulp locally to the project and saves it to the devDependencies in the package.json file

Install and save required gulp plugins using npm install [node_module_name] --save-dev

gulp-sass (https://github.com/dlmanning/gulp-sass)

    $ npm install gulp-sass --save-dev
    $ npm install gulp-notify --save-dev

TODO: Expand list of gulp plugins with links

###Setting up directory and files###

setup sass source directory

    $ mkdir sass/

setup sass source file

    $ touch sass/styles.scss

setup a Gulpfile

    $ touch gulpfile.js

setup the Gulpfile tasks

    $ vi gulpfile.js

contents of gulpfile.js

    var gulp = require('gulp');
    var sass = require('gulp-sass');
    var notify = require("gulp-notify");

    gulp.task ('sass', function() {
      return gulp.src ('./sass/**/*.scss')
      .pipe(sass( {errLogToConsole: true } ))
      .pipe (gulp.dest('./css'))
      .pipe(notify({ message: 'Stylesheet written - <%= file.relative %>' }));
    });

    gulp.task('watch', function() {
      gulp.watch('./sass/**/*.scss', ['sass']);
    });

    gulp.task('default', ['watch', 'sass']);

###setting up foundation###

initialize a bower config  file (this creates a bower.json file) (http://bower.io/docs/creating-packages/)

    bower init

say yes to all
TODO: add explanation of bower key-value pairs

create a new .bowerrc file

    $ touch .bowerrc

and add the following 3 lines to this file

    {
    "directory" : "bower_components"
    }

Install Foundation

    bower install -S foundation

Create a sass partial subdirectory mkdir - sass/partials

copy over the Foundatian settings partial, into your sass/partials directory

    $ cp bower_components/foundation/scss/foundation/_settings.scss sass/partials/

Create a new partial named _foundation.scss in the sass/partials/ directory

    $ touch _foundation.scss

Import any modules that you need, into the _foundations.scss partial, this file will only contain the modules you need to use.

Refer to the foundation documentation to choose which components you need for your layout.

Documentation found here: http://foundation.zurb.com/docs/

    @import "../../bower_components/foundation/scss/foundation/components/grid";
    @import "../../bower_components/foundation/scss/foundation/components/block-grid";
    @import "../../bower_components/foundation/scss/foundation/components/clearing";
    @import "../../bower_components/foundation/scss/foundation/components/top-bar";
    @import "../../bower_components/foundation/scss/foundation/components/type";
    @import "../../bower_components/foundation/scss/foundation/components/visibility";

Please note that we've updated our paths to the proper partial file locations installed by bower. We then need to correct the path in our other partial, _settings.scss, on line 58

Change this

    @import "foundation/functions";

to this

    @import "../../bower_components/foundation/scss/foundation/functions";

In your styles.scss file, import the two partials at the top of the file:

    @import "partials/settings";
    @import "partials/foundation";

Restart gulp in the command line

-----------

####Additional file/ folder setups####

1.Add in an images, js, and templates folder to your root directory

2.Set up a config.rb file

    $ touch config.rb

3.Edit the file and include the following:

    $ vi config.rb

    # Require any additional compass plugins here.
      add_import_path "bower_components/foundation/scss"

    # Set this to the root of your project when deployed:
      http_path = "/"
      css_dir = "css"
      sass_dir = "scss"
      images_dir = "images"
      javascripts_dir = "js"

      # You can select your preferred output style here (can be overridden via the command line):
      # output_style = :expanded or :nested or :compact or :compressed
      output_style = :expanded

      # To enable relative paths to assets via compass helper functions. Uncomment:
      relative_assets = true

      # To disable debugging comments that display the original location of your selectors. Uncomment:
      line_comments = false


      # If you prefer the indented syntax, you might want to regenerate this
      # project again passing --syntax sass, or you can uncomment this:
      # preferred_syntax = :sass
      # and then run:
      # sass-convert -R --from scss --to sass sass scss && rm -rf sass && mv scss sass

4.Set up the theme info file

    $ vi [theme_name].info

5.Some basic content:

    name        = [theme_name]
    screenshot  = [location of *screenshot.png*]
    description = [short description of the theme]
    core        = [core version number]

    stylesheets[all][] = css/styles.css

    ; Standard Regions
    regions[usermenu] = User menu
    regions[header] = Header
    regions[CTA] = Call to action (CTA)

    regions[mission] = Site mission
    regions[highlighted] = Highlighted
    regions[help] = Help
    regions[content] = Content

    regions[sidebar_first] = First sidebar
    regions[sidebar_second] = Second sidebar

    ; Extra footer menus
    regions[footermenu] = Footer menu

    ; Footer
    regions[footer] = Footer
    regions[footer_message] = Footer message



