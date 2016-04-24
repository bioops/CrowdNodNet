## Crowdsourcing nodulation gene network in *Lotus japonicus*

### Summary

In order to accurately and efficiently reconstruct nodulation gene network, a crowdsourcing platform, CrowdNodNet, was created. The platform implements the D3 JavaScript library, so that users are able to interactively visualize the gene network, and easily access the information about the network, e.g. gene list, gene interactions and gene functional annotations. More importantly, all the gene network information is written on MediaWiki pages, enabling users to edit the associated information. Utilizing the continuously updated, collaboratively written, and community-reviewed Wikipedia model, the platform could, in a short time, become a comprehensive knowledge base of nodulation-related pathways. The platform could also be used for other biological processes, and thus has great potential for integrating and advancing our understanding of the functional genomics and systems biology for any species. The platform is available at <http://crowd.bioops.info/>, and the source code is openly accessed at <https://github.com/bioops/crowdnodnet> under MIT License.

### Usage

* If you are interested in the nodulation gene network, you can access the website at <http://crowd.bioops.info/>. It is quite simple to use, and more information is available in the manuscript (link to be added).

* If you would like to create crowdsourcing platform for your own interested biological process, please read the following instructions.

### Create your own platform

1. Prepare a webserver with Apache and PHP.

2. Install and setup a [MediaWiki](https://www.mediawiki.org/wiki/MediaWiki) website.

3. Copy (`git clone`) source code of this package to the proper folder on your webserver, e.g. `/var/www/html/`.

4. Modify `title` and `wiki` in `config.json`. `title` is the platform title, and `wiki` is the your own wikimedia url, e.g <http://crowd.bioops.info/mediawiki/index.php>.

5. You can also edit `constraints` if necessary. 

 `constraints`: An array of objects that describe how to position the nodes. Each constraint should have a `type` field whose value should be either `'position'` or `'linkStrength'`, and a `has` field that specifies the conditions an object must meet for the constraints to be applied.

  **Position constraints**:  These constraints should have the properties
    `weight`, `x` (optional) and `y` (optional).  On each iteration of the
    force layout, node positions will be "nudged" towards the `x` and/or `y`
    values given, with a force proportional to the `weight` given.

  **Link strength constraints**:  These constraints should have the property `strength`, which is a multiplier on the link strength of the links to and from the objects that the constraint applies to.  This can be used to relax the position of certain nodes.

6. Your mediawiki website maybe enconter intensive spam attack. Make sure you read [this](https://www.mediawiki.org/wiki/Manual:Combating_spam) and add some antispam protections.

### Acknowlegement

**James Nylen**: The idea is derived from [d3-process-map](https://github.com/nylen/d3-process-map/), and some code are re-used or modified.
