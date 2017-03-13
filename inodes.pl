#!/usr/bin/perl -w

use strict;

sub count_inodes($);
sub count_inodes($)
{
  my $dir = shift;
  if (opendir(my $dh, $dir)) {
    my $count = 0;
    while (defined(my $file = readdir($dh))) {
      next if ($file eq '.' || $file eq '..');
      $count++;
      my $path = $dir . '/' . $file;
      $count += count_inodes($path) if (-d $path);
      # count_inodes($path) if (-d $path);
    }
    closedir($dh);
    if ( ( index($dir, "./virtfs/") == -1 ) && ( index($dir, "/www/") == -1 ) ) {
      printf "%7d\t%s\n", $count, $dir;
    }
  } else {
    warn "couldn't open $dir - $!\n";
  }
}

push(@ARGV, '.') unless (@ARGV);
while (@ARGV) {
  count_inodes(shift);
}

# count_inodes($path) if (-d $path);
