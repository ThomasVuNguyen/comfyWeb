import { createElement, Component, createRef } from '@wordpress/element'
import { ColorPicker } from '@wordpress/components'
import _ from '_'
import $ from 'jquery'
import { __ } from 'ct-i18n'

import { normalizeColor } from '../../helpers/normalize-color'

const ColorPickerIris = ({ onChange, value, value: { color } }) => {
	return (
		<div className={'ct-gutenberg-color-picker'}>
			<ColorPicker
				color={color}
				enableAlpha
				onChange={(color) => {
					onChange({
						...value,
						color: normalizeColor(color),
					})
				}}
			/>

			<div className="ct-option-color-value">
				<input
					onChange={({ target: { value: color } }) => {
						onChange({
							...value,
							color: normalizeColor(color),
						})
					}}
					value={normalizeColor(color)}
					type="text"
				/>
			</div>
		</div>
	)
}

export default ColorPickerIris
