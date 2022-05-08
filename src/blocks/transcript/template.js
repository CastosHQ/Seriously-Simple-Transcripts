import './editor.scss';

export function template({attributes, title}) {
    return (
        <div className="ssp-transcript">
            <div className="row">
                <div className="col">
                    <div className="tabs">
                        <div className="tab">
                            <input type="checkbox" id="chck1"/>
                            <label className="tab-label ssp-transcript-title"
                                   htmlFor="chck1"
                                   style={{color: attributes.titleColor, background: attributes.panelBg}}
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
