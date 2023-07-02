wp.blocks.registerBlockType("joetteams/joet-teams", {
    title: "Joet Teams",
    icon: "groups",
    category: "common",
    attributes: {
      teamMembers: { type: "number", default: 1 },
    },
    edit: function (props) {
      function updateTeamMembers(event) {
        props.setAttributes({teamMembers: parseInt(event.target.value)});
    }
  
      return (
        <div>
          <span>Choose how many Team Members you want to display: </span>
          <select onChange={updateTeamMembers} value={props.attributes.teamMembers}>
            <option value={2}>2 Members</option>
            <option value={3}>3 Members</option>
            <option value={4}>4 Members</option>
            <option value={5}>5 Members</option>
          </select>
        </div>
      );
    },
    save: function (props) {
      return null;
    },
  });
  