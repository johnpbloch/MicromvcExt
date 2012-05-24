MicroMVC Ext
============

MicroMVC Ext is a library of extensions for the [MicroMVC framework](https://github.com/Xeoncross/micromvc). Some of the libraries included will build on existing classes in the framework (such as `\Lib\Validation`), others will not.

To install MicroMVC Ext, place the `MicromvcExt` directory in MicroMVC's `Class` directory. The directory structure should be something like this:

```
your-project-directory
| --- Class
|     | --- Controller
|     | --- Core
|     | --- MicromvcExt
|     |     \ --- Lib
|     \ --- Model
| --- Command
| --- Config
 ... etc
 ```

 Alternatively, you can use MicroMVC Ext as a git submodule. To install it as a git submodule, run the following commands:

 ```
 cd path/to/your/project
 git submodule add git://github.com/johnpbloch/MicromvcExt.git Class/MicromvcExt
 git submodule init
 git submodule update
 ```

 To use the MicroMVC Ext libraries in your project, use them as follows:

 ```
 $validator = new \MicroMVC\Lib\Validation( $data );
 ```

 Use `use` statements to simplify the namespaces:

 ```
 use \MicroMVC\Lib as L;

 $validator = new L\Validation( $data );
 ```
