# Responsible Pet Owner Online - A Website of Penrith Council, NSW

This is the project repository for the development and maintenance of the Responsible Pet Owner Online website - 2017 version - a pilot project of Penrith Council in NSW.

## Project Organisation

Design phase files, sketches, client discussion notes and other resources not directly used in the frontend or backend development phases are placed in the `design_docs` folder. 

All project coding and development is done inside the `source` folder, and all active working files are placed there. Programming tools will then process these *source* files - eg., concatenating, compiling, transpiling, optimising and minifying them - and the result files are output inside the `build` folder. The `build` folder contains the finished files, which are to be used for testing, staging and final deployment.



## Languages

- **Plain HTML5**, with no special requirements.
- **SASS**, concatenatenated into a single file, compiled into CSS and minified.
- **plain Javascript**, concatenated, transpiled with [Babel][babel] and minified.
- **PHP**, suitable for deployment in modern servers with PHP ≥ 7.0.


## Frameworks & Libraries

The frontend template is built using [Foundation for Sites](http://foundation.zurb.com), version 6. This framework was chosen over others, as it has a good range of the basic interface elements needed to realise the conceptual design, and provides accessibility features out-of-the-box.

The backend is built with [Kirby](http://getkirby.com), version 2.4.2. This php-based, flat-file CMS was chosed due to its high-configurability, high compatibility with almost all shared hosting services, extreme ease of maintenance, and a user interface that is fool-proof and highly enjoyable for the client to use.

As the site is expected to have a high number of users with account registration required, a backend [MySQL](https://www.mysql.com) database has been built, with a custom-made interface added to the Kirby backend. 



## Development Tools

Design artboards were prepared with [Sketch][sketch]. Placeholder pictures provided by [Unsplash][unsplash]. Frontend processing of style and script files was done by [CodeKit][codekit]. The database schema was designed visually with [SQLEditor](https://www.malcolmhardie.com/sqleditor/).

[sketch]: https://www.sketchapp.com "Sketch"
[hype]: http://tumult.com/hype/ "Tumult Hype"
[fontawesome]: http://fontawesome.io "FontAwesome"
[unsplash]: https://unsplash.com "Unsplash" 
[sublime]: https://www.sublimetext.com "Sublime Text"
[uikit]: https://getuikit.com "UIKit"
[codekit]: https://codekitapp.com "CodeKit"
[jquery]: http://jquery.com "jQuery"
[bower]: https://bower.io "Bower"
[babel]: https://babeljs.io "Babel"
[tower]: https://www.git-tower.com "Tower"
[markdown]: https://en.wikipedia.org/wiki/Markdown "Markdown"
[less]: http://lesscss.org "Less"