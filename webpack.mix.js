const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
const { styles } = require("@ckeditor/ckeditor5-dev-utils");
const CKERegex = {
    svg: /ckeditor5-[^/\\]+[/\\]theme[/\\]icons[/\\][^/\\]+\.svg$/,
    css: /ckeditor5-[^/\\]+[/\\]theme[/\\].+\.css/,
};

Mix.listen("configReady", (webpackConfig) => {
    const rules = webpackConfig.module.rules;
    const targetSVG = /(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/;
    const targetFont = /(\.(woff2?|ttf|eot|otf)$|font.*\.svg$)/;
    const targetCSS = /\.p?css$/;

    for (let rule of rules) {
        if (rule.test.toString() === targetSVG.toString()) {
            rule.exclude = CKERegex.svg;
        } else if (rule.test.toString() === targetFont.toString()) {
            rule.exclude = CKERegex.svg;
        } else if (rule.test.toString() === targetCSS.toString()) {
            rule.exclude = CKERegex.css;
        }
    }
});

mix.js("resources/js/admin/app.js", "public/admin/js")
	.sass("resources/sass/admin/app.scss", "public/admin/css", {}, [tailwindcss('./tailwind.config.js')])
	.options({
		processCssUrls: false,
	})
	.autoload({
		"cash-dom": ["cash"],
	})
    .webpackConfig({
        module: {
            rules: [
                {
                    test: CKERegex.svg,
                    use: ["raw-loader"],
                },
                {
                    test: CKERegex.css,
                    use: [
                        {
                            loader: "style-loader",
                            options: {
                                injectType: "singletonStyleTag",
                                attributes: {
                                    "data-cke": true,
                                },
                            },
                        },
                        "css-loader",
                        {
                            loader: "postcss-loader",
                            options: {
                                postcssOptions: styles.getPostCssConfig({
                                    themeImporter: {
                                        themePath: require.resolve(
                                            "@ckeditor/ckeditor5-theme-lark"
                                        ),
                                    },
                                    minify: true,
                                }),
                            },
                        },
                    ],
                },
            ],
        },
    })
	.copyDirectory("resources/json", "public/admin/json")
	.copyDirectory("resources/fonts", "public/admin/fonts")
	.copyDirectory("resources/images", "public/admin/images")
	.browserSync({
		proxy: "rubick-laravel.test",
		files: ["resources/**/*.*"],
	});

mix.js("resources/js/admin/tasks/app.js", "public/admin/tasks")
    .vue()
