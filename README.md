# joet-teams
A dynamic Gutenberg block that displays random team members.
In order to use this block, you need use the [ACF plugin (free)](https://wordpress.org/plugins/advanced-custom-fields/) and create a custom post type Team Members along with some fields.
You can download the **team-members-fields-cpt.json** and import in the acf plugin.

## Class
**JoetTeams** - main class

## Functions

**__construct**() - constructor

**enqueueStyles**() - enqueue styles.css for frontend

**adminAssets**() - load the .js in build folder, and register the new block

**theHTML**() - the function responsible for the frontend display of the block

---

Example view of the frontend display of the block 
![Example View of Joet Teams in the frontend](/example-view.png)
