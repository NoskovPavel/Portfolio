const smartgrid = require('smart-grid');

const settings = {
    columns: 24,
    offset: '10px',
    container: {
        maxWidth: '1280px',
        fields: '30px'
    },
    breakPoints: {
        md: {
            width: "992px",
            fields: "20px"
        },
        sm: {
            width: "765px",
            fields: "10px"
        },
        xs: {
            width: "566px",
            fields: "5px"
        },
        xxs: {
            width: "521px",
            fields: "5px"
        }
    },
    oldSizeStyle: false,
    properties: [
        'justify-content'
    ]
};

smartgrid('./src/precss', settings);