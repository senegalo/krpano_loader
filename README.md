# KRpano Loader

KRpano loader is a small wordpress plugin that creates shortcodes to easily add KRPano tours to your website and 
display special content for each panorama.

## Instalation

* Clone the project into your `wp-content/plugins` directory.
* Go to the plugin management section in Wordpress and enable KRpano.

## Tours Upload

Currently the plugin doesn't manage the tours upload so you will have to upload them yourself. The plugin assumes that 
all the tours generated by KRpano are uploaded into the `wp-content/uploads/tours` directory.

So create the folder and upload all the tours into it. Note that each tour folder name will be used in the shortcode to determin which
tour to load.

## Usage

### Embed shortcode

To embed a pano simply add the following shortcode anywhere in page / post
```
[krpano tour='tour_name' width='500' height='300']
```
**tour** is the name of the folder under `wp-content/uploads/tours/` you want to load

**width** is an optional parameter to set the width of the player. Default is *500*

**height** is an optional parameter to set the height of the player. Default is *300*

### Define Scene Content

Each tour contains multiple scenes. They are defined in the tour.xml file generated by KRpano. Each scene contains a unique name.
To create a content that will only be shown when that scene is displayed add the following shorcode to the document containing
the embed shortcode for the tour:
```
[krpano_scene name='unique_scene_name']
  // all the content you can think of !
[/krpano_scene]
```
Initially all the content will be hidden and a special javascript will get activated when krpano loads a new scene. 
If a matching scene name is found in the content it will be shown otherwise all be hidden.
