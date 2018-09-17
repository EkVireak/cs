<?php 
	
	$sql_comment = "SELECT comment_id, comment_text, reply_count, comments.date_created as comment_date_created, comments.date_updated as comment_date_updated, users.avatar, users.username, users.user_id, users.date_created as users_date_created FROM comments INNER JOIN users ON comments.user_id = users.user_id ORDER BY comments.date_created ASC";
	$comment_selected = $conn->query($sql_comment);

 ?>	<input type="hidden" name="user-id" value="<?php echo $_SESSION['userlogin']['id']; ?>">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				asfd
			</div>
			<div class="col-md-6 comment-board-bg">
				<div class="comment-board">
				<div class="post">
					<?php echo $comment_selected->num_rows; ?> Comments
				</div>
					<!--  -->
					<?php if( $comment_selected->num_rows > 0 ): ?>
						<?php while( $comment_row = $comment_selected->fetch_assoc() ): ?>
							<?php 
								// var_dump($today_date);
								$comment_date_created = $comment_row['comment_date_created'];
								// var_dump($comment_date_created);
								$comment_date_created_timestamp = strtotime($comment_date_created);
								$ago = $today_timestamp - $comment_date_created_timestamp;

								$comment_id = $comment_row['comment_id'];

								$like_count_sql = "SELECT COUNT(*) FROM likes WHERE comment_id=$comment_id";
								$like_count_row = $conn->query($like_count_sql);

								if( $like_count_row->num_rows > 0  ){
									while( $row = $like_count_row->fetch_assoc() ){
										$like_count = (int)$row['COUNT(*)'];
									}
								}

								$reply_count_sql = "SELECT COUNT(*) FROM replies WHERE comment_id=$comment_id";
								$reply_count_row = $conn->query($reply_count_sql);

								if( $reply_count_row->num_rows > 0  ){
									while( $row = $reply_count_row->fetch_assoc() ){
										$reply_count = (int)$row['COUNT(*)'];
									}
								}
							 ?>
					<div class="comment-wrap">
						<div class="comment">
							<div class="row">
								<div class="avatar-wrap">
									<div class="avatar-wrap-inner">
										<div class="avatar align-center">
											<?php echo get_user_avatar($comment_row['username'], $comment_row['avatar']); ?>
											<!-- <img src="<?php //echo BASE_URL; ?>/users/<?php //echo $comment_row['username'].'/'.$comment_row['avatar']; ?>"> -->
										</div>
									</div>
								</div>
								<div class="comment-box-wrap">
									<div class="comment-box-inner">
										<div class="comment-box">
											<div class="comment-user">
												@<?php echo $comment_row['username'] ?> - <?php echo format_ago($ago); ?> ago
											</div>
											<div class="comment-text">
												<p><?php echo htmlspecialchars($comment_row['comment_text']); ?></p>
											</div>
										</div>
										<div class="comment-reaction">
											<div class="like-wrap">
												<strong>
													<a href="#">
														<span class="LIKE" comment-id="<?php echo $comment_id; ?>">Like</span>
													</a> : 
												</strong>
												<a href="#">
													<span class="LIKE_COUNT" comment-id="<?php echo $comment_id; ?>" id="LIKE_COUNT_<?php echo $comment_id; ?>"><?php echo $like_count; ?></span>
												</a>
											</div>
											<div class="reply-wrap">
												<strong>
													<a href="#FORM_COMMENT_REPLY_<?php echo $comment_id; ?>">
														<span class="REPLY">Reply</span>
													</a> : 
												</strong>
												<a href="#">
													<span class="REPLY_COUNT" id="REPLY_COUNT_<?php echo $comment_id; ?>"><?php echo $reply_count; ?></span>
												</a>
											</div>
											<div class="edit-wrap">
												<strong>Edit </strong><span></span>
											</div>
										</div>
										<div class="comment-reply">
											<!--  -->
										<?php if( $reply_count > 0 ): ?>
											<?php 
											$sql_reply = "SELECT reply_id, comment_id, replies.user_id as user_id, reply_text, replies.date_created as reply_date_created, replies.date_updated as reply_date_updated, users.avatar, users.username FROM replies INNER JOIN users ON replies.user_id = users.user_id WHERE comment_id=".$comment_id." ORDER BY replies.date_created ASC";
											$reply_selected = $conn->query($sql_reply);
											?>
											
											<?php if( $reply_selected->num_rows > 0 ): ?>
												<?php while( $reply_row = $reply_selected->fetch_assoc() ): ?>
												<?php
													$reply_date_created_timestamp = strtotime($reply_row['reply_date_created']);
													$ago = $today_timestamp - $reply_date_created_timestamp;
													
												 ?>
											<div class="comment-wrap">
												<div class="comment">
													<div class="row">
														<div class="avatar-wrap">
															<div class="avatar-wrap-inner">
																<div class="avatar align-center">
																	<?php echo get_user_avatar($reply_row['username'], $reply_row['avatar']); ?>
																</div>
															</div>
														</div>
														<div class="comment-box-wrap">
															<div class="comment-box-inner">
																<div class="comment-box">
																	<div class="comment-user">
																		@<?php echo $reply_row['username']; ?> - <?php echo format_ago($ago); ?> ago
																	</div>
																	<div class="comment-text">
																		<p><?php echo $reply_row['reply_text']; ?></p>
																	</div>
																</div>
																<div class="comment-reaction">
																	<div class="like-wrap">
																		<strong>Like : </strong><span><?php  ?></span>
																	</div>
																	<div class="reply-wrap">
																		<strong>Reply</strong>
																	</div>
																	<div class="edit-wrap">
																		<strong>Edit </strong><span></span>
																	</div>
																</div>
																<div class="comment-reply">
													
																</div><!-- .comment-reply -->
															</div>
														</div>
													</div><!-- .row -->
												</div><!-- .comment-main -->
											</div><!-- .comment -->
												<?php endwhile; ?>
											<?php endif; ?>
										<?php endif; ?>
										<?php if( isset($_SESSION['userlogin']) && is_array($_SESSION['userlogin']) ): ?>
											<div class="form-comment-reply" id="FORM_COMMENT_REPLY_<?php echo $comment_id; ?>">
												<form method="POST" class="form-reply" comment-id="<?php echo $comment_id; ?>">
													<div class="comment-wrap">
														<div class="comment">
															<div class="row">
																<div class="avatar-wrap">
																	<div class="avatar-wrap-inner">
																		<div class="avatar align-center">
																			<?php echo get_avatar(); ?>
																		</div>
																	</div>
																</div>
																<div class="comment-box-wrap">
																	<div class="comment-box-inner">
																		<div class="form-group">
																			<!-- <textarea class="form-control input-radius" placeholder="Write a reply ..."></textarea> -->
																			<input class="form-control input-radius" type="text" name="reply-text_<?php echo $comment_id; ?>" placeholder="Write a reply ...">
																		</div>
																	</div>
																</div>
															</div><!-- .row -->
														</div><!-- .comment-main -->
													</div><!-- .comment -->											
												</form>
											</div><!-- .form-comment-reply -->
										<?php endif; ?>
										</div><!-- .comment-reply -->
									</div>
								</div>
							</div><!-- .row -->
						</div><!-- .comment -->
					</div><!-- .comment-wrap -->
						<?php endwhile; ?>
					<?php endif; ?>
					<?php if( isset($_SESSION['userlogin']) && is_array($_SESSION['userlogin']) ): ?>
					<div class="form-comment">
						<form method="POST" id="form-comment">
							<div class="comment-wrap">
								<div class="comment">
									<div class="row">
										<div class="avatar-wrap">
											<div class="avatar-wrap-inner">
												<div class="avatar align-center">
													<?php echo get_avatar(); ?>
												</div>
											</div>
										</div>
										<div class="comment-box-wrap">
											<div class="comment-box-inner">
												<div class="form-group">
													<input type="text" class="form-control input-radius" name="comment-text" placeholder="Write a comment ..." autocomplete="off">
												</div>
											</div>
										</div>
									</div><!-- .row -->
								</div><!-- .comment -->
							</div><!-- .comment-wrap -->
						</form><!-- #form-comment -->
					</div>
					<?php endif; ?>
					<!--  -->
				</div><!-- .comment-board -->
			</div>
			<div class="col-md-3">
				<div class="btn-active pointer">
					<div class="avatar">
						<div>
							<div>
								Online
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>