const Menu = [
    {
        icon: "home",
        title: "Home",
        name: "Home",
        to: "/home"
    },
    {
        icon: "dashboard",
        title: "Dashboard",
        name: "Dashboard",
        to: "/dashboard"
    },
    {
        icon: "insert_drive_file",
        title: "Forms",
        group: "forms",
        model: false,
        children: [{
                title: "Barangay Clearance",
                name: "Barangay Clearance",
                to: "/barangayclearance"
            },
            {
                title: "Business Clearance",
                name: "Business Clearance",
                to: "/businessclearance"
            },
            {
                title: "Barangay Certificate",
                name: "Barangay Certificate",
                to: "/barangaycertificate"
            }
        ]
    },
    {
        icon: "account_box",
        title: "Inhabitant",
        name: "Inhabitant",
        to: "/inhabitant"
    },
    {
        icon: "calendar_today",
        title: "Calendar",
        name: "Calendar",
        to: "/calendar"
    }
];
Menu.forEach((item) => {
    if (item.items) {
      item.items.sort((x, y) => {
        let textA = x.title.toUpperCase();
        let textB = y.title.toUpperCase();
        return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
      });
    }
  });
  export default Menu;