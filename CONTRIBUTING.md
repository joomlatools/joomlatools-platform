# How to contribute

Contributions and patches are essential for the success of our [Joomlatools](http://developer.joomlatools.com) 
open source projects. We simply can't access the huge number of platforms 
and myriad configurations for running our code. We want to keep it as easy 
as possible to contribute changes that get things working in your environment. 
There are a few guidelines that we need contributors to follow so that we 
can have a chance of keeping on top of things.

Following these guidelines helps to communicate that you respect the time of
the developers managing and developing our open source projects. In return,
they should reciprocate that respect in addressing your issue or assessing
patches and features.

Please take a moment to review this document in order to make the contribution
process easy and effective for everyone involved.

## Core vs Extensions

All our open source projects are extensible. New functionality is typically 
directed toward extensions to provide a slimmer Core, reducing its surface 
area, and to allow greater freedom for extension maintainers to ship releases 
at their own cadence, rather than being held to the cadence of Core releases. 
All our projects are build to be packageble and extensible using [Composer](https://getcomposer.org/).

If you are unsure of whether your contribution should be implemented as an 
extension or part of the Core, you may visit
[joomlatools/dev on Gitter](http://gitter.im/joomlatools/dev) or ask on the
[Joomlatools dev mailing list](https://groups.google.com/forum/#!forum/joomlatools-dev)
for advice.

## Using the issue tracker

The issue tracker is the preferred channel for [bug reports](#bugs),
[features requests](#features) and [submitting pull
requests](#pull-requests), but please respect the following restrictions:

* Please **do not** use the issue tracker for personal support requests (use the
  [Joomlatools mailing list](https://groups.google.com/forum/#!forum/joomlatools-dev)).

* Please **do not** derail or troll issues. Keep the discussion on topic and
  respect the opinions of others.


<a name="bugs"></a>
## Bug reports

A bug is a _demonstrable problem_ that is caused by the code in the repository.
Good bug reports are extremely helpful - thank you!

Guidelines for bug reports:

1. **Use the GitHub issue search** &mdash; check if the issue has already been
   reported.

2. **Check if the issue has been fixed** &mdash; try to reproduce it using the
   latest `master` or development branch in the repository.

3. **Isolate the problem** &mdash; make sure that the code in the repository is
_definitely_ responsible for the issue.

A good bug report shouldn't leave others needing to chase you up for more
information. Please try to be as detailed as possible in your report.


<a name="features"></a>
## Feature requests

Feature requests are welcome. But take a moment to find out whether your idea
fits with the scope and aims of the project. It's up to *you* to make a strong
case to convince the Joomlatools developers of the merits of this feature. Please
provide as much detail and context as possible.


<a name="pull-requests"></a>
## Pull requests

Good pull requests - patches, improvements, new features - are a fantastic
help. They should remain focused in scope and avoid containing unrelated
commits.

**Please ask first** before embarking on any significant pull request (e.g.
implementing features, refactoring code), otherwise you risk spending a lot of
time working on something that the developers might not want to merge into the
project.

Please adhere to the coding conventions used throughout the project (indentation,
comments, etc.).

Adhering to the following this process is the best way to get your work
merged:

1. [Fork](http://help.github.com/fork-a-repo/) the repo, clone your fork,
   and configure the remotes:

   ```bash
   # Clone your fork of the repo into the current directory
   git clone https://github.com/<your-username>/<repo-name>
   # Navigate to the newly cloned directory
   cd <repo-name>
   # Assign the original repo to a remote called "upstream"
   git remote add upstream https://github.com/<upsteam-owner>/<repo-name>
   ```

2. If you cloned a while ago, get the latest changes from upstream:

   ```bash
   git checkout <dev-branch>
   git pull upstream <dev-branch>
   ```

3. Create a new topic branch (off the main project development branch) to
   contain your feature, change, or fix:

   ```bash
   git checkout -b <topic-branch-name>
   ```

4. Commit your changes in logical chunks. Please adhere to these [git commit
   message guidelines](http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html)
   or your code is unlikely be merged into the main project. Use Git's
   [interactive rebase](https://help.github.com/articles/interactive-rebase)
   feature to tidy up your commits before making them public.

5. Locally merge (or rebase) the upstream development branch into your topic branch:

   ```bash
   git pull [--rebase] upstream <dev-branch>
   ```

6. Push your topic branch up to your fork:

   ```bash
   git push origin <topic-branch-name>
   ```

10. [Open a Pull Request](https://help.github.com/articles/using-pull-requests/)
    with a clear title and description.

To increase the chance that your pull request is accepted make sure to write tests and [good commit messages](http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html).
    
<a name="contributor-copyright"></a>

# Contributor Guidelines

## Copyright
 
As a contributor, you retain the copyright to your code, however by contributing 
code to one of our Joomlatools code repositories you are releasing your code under 
the same license terms as specified in the LICENSE.txt file included in each 
repository. In most cases this will be the GPLv3 or MPLv2 licenses.

## Code of Conduct 

The community is one of the best features of our Joomlatools projects, and we want to ensure it remains welcoming and safe for everyone. We have adopted the [Open Code of Conduct](http://todogroup.org/opencodeofconduct/#Joomlatools/contact@joomlatools.com) for all projects in the [@joomlatools GitHub organization](http://www.github.com/joomlatools), our [discussion forum](https://groups.google.com/forum/#!forum/joomlatools-dev), and [gitter chat room](https://gitter.im/joomlatools/chat). 

This code of conduct outlines the expectations for all community members, as well as steps to report unacceptable behavior. We are committed to providing a welcoming and inspiring community for all and expect our code of conduct to be honored.

Read more about the Open Code of Conduct on the [TODO Group blog](http://todogroup.org/blog/open-code-of-conduct/).
