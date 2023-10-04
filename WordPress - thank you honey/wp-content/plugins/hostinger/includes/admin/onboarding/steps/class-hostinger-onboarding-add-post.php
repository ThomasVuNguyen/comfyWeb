<?php

class Hostinger_Onboarding_Add_Post extends Hostinger_Onboarding_Step {
	public function get_title(): string {
		return __( 'Create your first blog post', 'hostinger' );
	}

	public function get_body(): array {
		return [
			[
				'title'       => __( 'Create a catchy headline', 'hostinger' ),
				'description' => __( 'Create a headline that grabs your visitors attention and accurately represents the content of your post.', 'hostinger' )
			],
			[
				'title'       => __( 'Draft your post', 'hostinger' ),
				'description' => __( 'Write your content, making sure to include relevant keywords and images. You can use different blocks to create headings, paragraphs, lists, and other types of content.', 'hostinger' ),
			],
			[
				'title'       => __( 'Proofread and publish', 'hostinger' ),
				'description' => __( 'Once you have finished drafting your post, read it over to check for errors, make any necessary revisions, and then publish it to your blog.', 'hostinger' ),
			],
		];
	}

	public function step_identifier(): string {
		return 'add_post';
	}

	public function get_redirect_link(): string {
		return admin_url( 'post-new.php' );
	}
}
