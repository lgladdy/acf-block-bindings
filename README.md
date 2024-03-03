### ACF Block Bindings Demo

This repo serves as a demo plugin for how Block Bindings for ACF fields could work in WordPress 6.5. The code in this plugin is just a quick demo of how things could work, and any final form that makes it into ACF may work differently.

Trying to avoid the security shortcomings of the ACF shortcode, bindings are only currently allowed to be on post fields assigned to the post ID currently being edited. This means, the fields need to be assigned to the post type being edited, and presented via the legacy metabox, which will move to a new panel in upcoming WordPress 6.5 betas/RCs, rather than currently being at the bottom of the editor pane.

Block Bindings are currently only editable via code view, although this will become a UI in future WordPress releases.

You can bind any ACF field on the current post object to any WordPress Core Block binding. You can find the [full list of core blocks and their supported binding attributes here](https://developer.wordpress.org/news/2024/02/20/introducing-block-bindings-part-1-connecting-custom-fields/)

Here's a sample, of an WordPress Core Image Block, bound to an ACF image field for the URL, and a text field for the description. You need to make sure the return type for the image field is set to URL for this to work.

```html
<!-- wp:image {
	"metadata":{
		"bindings":{
			"url":{
				"source":"acf/post",
				"args":{
					"key":"featured_image"
				}
			},
			"alt":{
				"source":"acf/post",
				"args":{
					"key":"featured_image_description"
				}
			}
		}
	}
} -->
<figure class="wp-block-image">
<img src="" alt="" />
</figure>
<!-- /wp:image -->
```

### To Do
- Find a secure way to introduce access to option values. This will likely require additional code to make a list of option values which are available to block bindings. This will likely be a seperate binding, with a name of `acf/option` but, maybe this could all live on _one true block binding_ source that could be `acf/field`
- Once the security is figured out for option values, the same could allow to allow access to other fields on other post types too.