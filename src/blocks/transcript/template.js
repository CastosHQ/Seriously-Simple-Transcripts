import './editor.scss';

export function template({attributes, title}) {

    const getTitleStyle = function (attributes) {
        const titleStyle = {};
        const attributeSettings = wp.data.select('core/blocks').getBlockType('create-block/castos-transcript').attributes;

        if (attributes.titleColor !== attributeSettings.titleColor.default) {
            titleStyle['color'] = attributes.titleColor;
        }

        if (attributes.panelBg !== attributeSettings.panelBg.default) {
            titleStyle['background'] = attributes.panelBg;
        }

        if (attributes.titleSize !== attributeSettings.titleSize.default) {
            titleStyle['fontSize'] = attributes.titleSize + 'px';
        }

        return titleStyle
    }

    return (
        <div className="ssp-transcript">
            <div className="row">
                <div className="col">
                    <div className="tabs">
                        <div className="tab">
                            <input type="checkbox" id="chck1" />
                            <label className="tab-label ssp-transcript-title"
                                   htmlFor="chck1"
                                   style={getTitleStyle(attributes)}
                            >{title}</label>
                            <div className="tab-content ssp-transcript-content">
                                {attributes.content}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
