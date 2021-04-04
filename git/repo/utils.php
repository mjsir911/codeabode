<?php
namespace utils;

function commit_event($repo, $c, $full_body=False, $refs=array(), $full_id=false, $diff=Null, $href=Null, $parents=False, $skip_body=False, $target_blank=False, $path=Null) { ?>
<div>
  <? if($full_id): ?>
  <?=$c->id()->hex?>
  <? else: ?>
  <a
    <? if($href): ?>
    href="<?=$href?>"
    <? else: ?>
    href="<?=url_for("repo.commit", owner: $repo->owner->canonical_name,
      repo: $repo->name, ref: $c->id()->hex)?><? if($path): ?>#<?=$path?><? endif; ?>"
    <? endif; ?>
    title="<?=git_oid_tostr($c->id(), 64)?>"
    <? if($target_blank): ?>
    target="_blank"
    <? endif; ?>
  ><?=git_oid_tostr($c->id(), 8)?></a>
  <? endif; ?>
  &mdash;
  <? $author_user = lookup_user($c->author->email) ?>
  <? if($author_user): ?>
  <a href="<?=url_for("public.user_index",
    username: $author_user->username)?>"><?=$c->author->name ?></a>
  <? else: ?>
  <?=$c->author->name?>
  <? endif; ?>
  <small class="pull-right">
    <a
      id="log-<?=$c->id()?>"
      href="#log-<?=$c->id()?>"
    ><?#= commit_time($c) | date ?></a>
  </small>

  <? if($parents and any($c->parents)): ?>
  <span style="margin-left: 0.5rem">
    <?=icon('code-branch', cls: "sm")?>
    <? foreach($c->parents as $parent): ?>
    <a href="<?=url_for("repo.commit",
      owner: $repo->owner->canonical_name,
      repo: $repo->name,
      ref: parent->id->hex)?>"
    ><?=parent->short_id?></a>
    <!--
    <? # if(not loop->last): ?>
    +
    <? # endif; ?>
    -->
    <? endforeach; ?>
  </span>
  <? endif; ?>

  <? if(in_array($c->id()->hex, $refs)): ?>
  <span style="margin-left: 0.5rem">
    <? foreach($refs[$c->id()->hex] as $ref): ?>
    <a
      class="ref <?=$ref->type?>
        <?=$ref->type == "tag" and $ref->tag->message ? "annotated" : "" ?>"
      <? if($ref->type == "branch"): ?>
      href="{{url_for("repo.tree",
        owner=$repo->owner->canonical_name, repo=$repo->name, ref=$ref->name)}}"
      <? elseif(ref.type == "tag"): ?>
      href="{{url_for("repo.ref",
          owner=$repo->owner->canonical_name,
          repo=$repo->name,
          ref=$ref->name)}}"
      <? endif; ?>
    ><?=$ref->name->decode("utf-8", "replace")?></a>
  </span>
  <? endforeach; ?>
  <? endif; ?>
</div>
<? if(! $skip_body): ?>
<? if($full_body): ?>
<pre class="commit"><?=$c->message()?>
<? if($diff): ?>
<?=diffstat($diff, anchor: $c->oid->hex + "-")?><? endif; ?>
</pre>
<? else: ?>
<pre class="commit"><?= ($c->summary()) ?></pre>
<? endif; ?>
<? endif; ?>
<?
}

?>
